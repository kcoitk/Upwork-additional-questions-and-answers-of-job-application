$(document).ready(function(){
	$('.nav-tabs a').each(function(){
		$('.nav-tabs a').click(function(e){
			var tab_id = $(this).attr('href');
			$(this).parents('ul').next('.tab-container').find('.tab-content').removeClass('in');
			$(tab_id).addClass('in');
			$(this).parents('ul').find('li').removeClass('active');
			$(this).parent().addClass('active');
			e.preventDefault();
		});
	});
	
	$('.stitle').autocomplete({
		source: 'search.php',
		minLength: 1
	});
	
});