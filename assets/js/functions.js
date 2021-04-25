(function($){
	$(document).ready(function (){

	    web365.main.initValidate();
	    web365.main.initEvent();
	    web365.main.initSignalr();

        $(document).on('click','.pu-imenu',function(e){
            e.preventDefault();
            $(".pu-menutop").toggleClass("pumnshow");
        });

	});
})(window.jQuery);
