<style>
	
	.main_menu > li > a {
        color: {{ setting('site.texto_barra_navegacao') }};
    }

    section{
        background-color: {{ setting('site.fundo_website') }};
    }

    #page-content{
        background-color: {{ setting('site.fundo_website') }};
    }

    footer{
        background-color: {{ setting('site.barra_navegacao') }};
    }

    .flex-w .p-t-30 h4, .flex-w .p-t-30 a, .flex-w .p-t-30 p, #copyright, #copyright a {
        color: {{ setting('site.texto_barra_navegacao') }};
    }

    .bgwhite{
        background-color: {{ setting('site.fundo_website') }};
    }

    .bgwhite h3, .bgwhite h4{
        color: {{ setting('site.cor_titulos') }};
    }

    #loja h4, #loja p, #loja span, #loja div, #loja h6{
        color: {{ setting('site.cor_titulos') }};
    }

    .cart th, .cart h5, .cart .s-text18, .cart .m-text22, #profile label, #profile h3, #profile .fa-plus{
        color: {{ setting('site.cor_titulos') }}!important;
    }

    .cart div, .cart .m-text21, .bgwhite p, #loja a{
        color: {{ setting('site.cor_textos') }}!important;
    }
            
</style>