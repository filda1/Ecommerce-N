var Cart = {};

Cart.on = function(eventName, callback) {
  if (!Cart.callbacks[eventName]) Cart.callbacks[eventName] = [];
  Cart.callbacks[eventName].push(callback);
  return Cart;
};

Cart.trigger = function(eventName, args) {
  if (Cart.callbacks[eventName]) {
    for (var i = 0; i<Cart.callbacks[eventName].length; i++) {
      Cart.callbacks[eventName][i](args||{});
      console.log(Cart.callbacks[eventName][i]);
    }
  }
  return Cart;
};

Cart.save = function() {
  localStorage.setItem('cart-items', JSON.stringify(Cart.items));
  Cart.trigger('saved');
  return Cart;
};

Cart.empty =  function() {
  Cart.items = [];
  Cart.trigger('emptied');
  Cart.save();
  return Cart;
};

Cart.indexOfItem = function(id) {
  for (var i = 0; i<Cart.items.length; i++) {
    if (Cart.items[i].id===id) return i;
  }
  return null;
};

Cart.removeEmptyLines = function() {
  newItems = [];
  for (var i = 0; i<Cart.items.length; i++) {
    if (Cart.items[i].quantity>0) newItems.push(Cart.items[i]);
  }
  Cart.items = newItems;
  return Cart;
};

Cart.addItem = function(item) {
  if (!item.quantity) item.quantity = 1;
  var index = Cart.indexOfItem(item.id);
  if (index===null) {
    Cart.items.push(item);
  } else {
    Cart.items[index].quantity += item.quantity;
  }
  Cart.removeEmptyLines();
  if (item.quantity > 0) {
    Cart.trigger('added', {item: item});
  } else {
    Cart.trigger('removed', {item: item});
  }
  Cart.save();
  return Cart;
};

Cart.removeItem = function(item_id) { 
  newItems = [];
  for (var i = 0; i<Cart.items.length; i++) {
    if (Cart.items[i]["id"] != item_id) newItems.push(Cart.items[i]);
  }
  Cart.items = newItems;
  Cart.save();
}

Cart.itemsCount = function() {
  var accumulator = 0;
  for (var i = 0; i<Cart.items.length; i++) {
    accumulator += Cart.items[i].quantity;
  }
  return accumulator;
};

Cart.currency = '€';

Cart.displayPrice = function(price) {
  if (price===0){
    if(Cart.items.length <= 0){
      return 'Carrinho Vazio';
    }else{
      return 'Free';
    }
  } 
  var floatPrice = price/100;
  var decimals = floatPrice==parseInt(floatPrice, 10) ? 0 : 2;
  return price.toFixed(decimals) + Cart.currency;
};

Cart.linePrice = function(index) {
  return Cart.items[index].price * Cart.items[index].quantity;
};

Cart.subTotal = function() {
  var accumulator = 0;
  for (var i = 0; i<Cart.items.length; i++) {
    accumulator += Cart.linePrice(i);
  }
  return accumulator;
};

Cart.init = function() {
  var items = localStorage.getItem('cart-items');
  if (items) {
    Cart.items = JSON.parse(items);
  } else {
    Cart.items = [];
  }
  Cart.callbacks = {};
  return Cart;
}

Cart.initJQuery = function() {

  Cart.init();

  Cart.templateCompiler = function(a,b){return function(c,d){return a.replace(/#{([^}]*)}/g,function(a,e){return Function("x","with(x)return "+e).call(c,d||b||{})})}};

  Cart.lineItemTemplate = '<li class="header-cart-item">'+
                              '<div data-id="#{this.id}" class="header-cart-item-img cart-remove">'+
                                  '<img src="#{this.image}" alt="IMG">'+
                              '</div>'+

                              '<div class="header-cart-item-txt">'+
                                  '<a href="#" class="header-cart-item-name">'+
                                      '#{this.label}'+
                                  '</a>'+

                                  '<span class="header-cart-item-info">'+
                                      '#{this.quantity} x #{Cart.displayPrice(this.price)}'+
                                  '</span>'+
                              '</div>'+
                          '</li>';

  Cart.tableItemTemplate = '<tr class="table-row">'+
                              '<td class="column-1">'+
                                '<div data-id="#{this.id}" class="cart-img-product b-rad-4 o-f-hidden cart-remove">'+
                                  '<img src="#{this.image}" alt="IMG-PRODUCT">'+
                                '</div>'+
                              '</td>'+
                              '<td class="column-2">#{this.label}</td>'+
                              '<td class="column-3">#{Cart.displayPrice(this.price)}</td>'+
                              '<td class="column-4">'+
                                '<div class="flex-w bo5 of-hidden w-size17">'+
                                  '<button data-id="#{this.id}" data-quantity="-1" class="cart-add btn-num-product-down color1 flex-c-m size7 bg8 eff2">'+
                                    '<i class="fs-12 fa fa-minus" aria-hidden="true"></i>'+
                                  '</button>'+

                                  '<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="#{this.quantity}">'+

                                  '<button data-id="#{this.id}" data-quantity="1" class="cart-add btn-num-product-up color1 flex-c-m size7 bg8 eff2">'+
                                    '<i class="fs-12 fa fa-plus" aria-hidden="true"></i>'+
                                  '</button>'+
                                '</div>'+
                              '</td>'+
                              '<td class="column-5">#{Cart.displayPrice(this.price*this.quantity)}</td>'+
                            '</tr>';

  $(document).on('click', '.cart-add', function(e) {
    e.preventDefault();
    var button = $(this);
    var item = {
      id: button.data('id'),
      price: button.data('price'),
      quantity: button.data('quantity'),
      label: button.data('label'),
      image: button.data('image')
    }
    Cart.addItem(item);
  });

  var updateReport = function() {
    var count = Cart.itemsCount();
    $('.cart-items-count').text(count);
    $('.cart-subtotal').html(Cart.displayPrice(Cart.subTotal()));
    if (count===1) {
      $('.cart-items-count-singular').show();
      $('.cart-items-count-plural').hide();
    } else {
      $('.cart-items-count-singular').hide();
      $('.cart-items-count-plural').show();
    }
  };

  var updateCart = function() {
    if (Cart.items.length>0) {
      var templateLine = Cart.templateCompiler(Cart.lineItemTemplate);
      var templateTable = Cart.templateCompiler(Cart.tableItemTemplate);
      var lineItems = "";
      var tableItems = "";
      for (var i = 0; i<Cart.items.length; i++) {
        lineItems += templateLine(Cart.items[i]);
        tableItems += templateTable(Cart.items[i]);
      }
      $('.cart-line-items').html(lineItems);
      $('.cart-table-items').html(tableItems);
      $('.cart-table').show();
      $('.cart-is-empty').hide();
      $('.cart-items-actions').show();

      $('.cart-remove').click(function(e) {
        e.preventDefault();
        var button = $(this);
        Cart.removeItem(button.data('id'));
      });
    } else {
      $('.cart-table').hide();
      $('.cart-line-items').empty();
      $('.cart-table-items').empty();
      $('.cart-is-empty').show();
      $('.cart-items-actions').hide();
    }
  };

  var update = function() {
    updateReport();
    updateCart();
  };
  update();

  Cart.on('saved', update);

  return Cart;
};
