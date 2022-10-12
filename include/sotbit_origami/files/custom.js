$( document ).ready(function() {


    $('.click_menu').click(function(){
        $('.header-two__nav').toggleClass('hover-second');
        $('body').toggleClass('body-lock');
    });


    $('.header-two__btn-fixed-menu').click(function(){
        $('.header-two__nav').toggleClass('hover-second');
    });


    $("#menu").mmenu({
        "extensions": [
            "pagedim-black"
        ]
    });

    $('.stars-list svg').click(function(){
        $.ajax({
            type: "POST",
            url: '/local/ajax/vote.php',
            data: 'VOTE='+$(this).attr('data-value'),
            success: function(response)
            {
                $('.vote-block').remove();
            }
        });

    });


  $('.custom_svg_passw').click(function(){
        if($(this).parent().find('input').attr('type')=='password'){
          $(this).parent().find('input').attr('type','text');
        }else{
          $(this).parent().find('input').attr('type','password');
        }
      });
  /*
$("a").click(function () {

    var elementClick = $(this).attr("href");
    if(elementClick !='javascript:void(0)'){
    var destination = $(elementClick).offset().top;
    destination -= 320;
    console.log(destination);
    $('html, body').animate({ scrollTop: destination }, 600);
    }
    return false;
});
*/




      $('.filter_border_animbate').click(function(){


          $('#filter_href').css({"border": "0px solid red"}).animate({
              'borderWidth': '1px',
              'borderColor': 'red'
          },1500);



          setTimeout(function tick() {
            $('#filter_href').animate({
              'borderWidth': '0px',
              'borderColor': 'unset'
          },1500);

          }, 1500);


      });




  $('.feedback_block__compliance').click(function(){
$(this).find('.error_custom').remove();
});

   function setEqualHeight(columns)
{
var tallestcolumn = 0;
columns.each(
function()
{
currentHeight = $(this).height();
if(currentHeight > tallestcolumn)
{
tallestcolumn = currentHeight;
}
}
);
columns.height(tallestcolumn +1);
}

setEqualHeight($('.product-card-inner__title'));
setEqualHeight($('.ARTICUL_block'));
setEqualHeight($('.block_cart_many'));
  // Handler for .ready() called. input_search 

  $('.click_menu_show').click(function(){
            $(this).toggleClass('hide_text_show');
            $(this).parent().parent().find('.hidden_menu_li').toggleClass('inline_block');
        });


  $('.click_menu_show_depth_1').click(function(){
            $(this).toggleClass('hide_text_show');
            $(this).parents('.menu__col-list').find('.hidden_depth_level2').toggleClass('inline_block_depth1');
        });



var inputs = document.querySelectorAll('.inputfile');
Array.prototype.forEach.call(inputs, function(input){
  var label  = $(input).next(),
      labelVal = label.innerHTML;
  input.addEventListener('change', function(e){
      console.log('changeFile')
    var fileName = '';
    if( this.files && this.files.length > 1 )
      fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
    else
      fileName = e.target.value.split( '\\' ).pop();
    if( fileName ){
      console.log(fileName)

      $( label ).html(fileName);
    }
    else
      {
         $( label ).html(labelVal);
      }
  });
});

});


const tabHover = {
    open(idTab) {
        const tabNow = document.querySelector(idTab);
        const tabBtnNow = document.querySelector(
            `[data-tab-target-hover='${idTab}']`
        );
        // const parentBtnNow = tabBtnNow.closest('.services__age-buttons');
        // const parentTabNow = tabNow.closest('.menu');
        const tabsBtn = document.querySelectorAll('.j_tabs__button_hover');
        const tabsContent = document.querySelectorAll('.j_tabs__content_hover');


        tabsBtn.forEach((element) => {
            element.classList.remove('active');
        });

        tabBtnNow.classList.add('active');

        tabsContent.forEach((element) => {
            element.classList.remove('active');
        });

        tabNow.classList.add('active');
    },

    initAll() {
        const tabAttr = document.querySelectorAll('[data-tab-target-hover]');

        tabAttr.forEach((element) => {
            element.addEventListener('mouseover', function (e) {
                e.preventDefault();
                const idTab = e.target.dataset.tabTargetHover;

                if (idTab && idTab !== '') {
                    tabHover.open(idTab);
                }
            });
        });
    },
};

window.onload = function () {
    tabHover.initAll();
};
window.tabHover = tabHover;




const div = document.querySelector('.header-two__nav');
const body = document.querySelector('body');
 
document.addEventListener( 'click', (e) => {
	const withinBoundaries = e.composedPath().includes(div);
 
	if ( ! withinBoundaries ) {
		div.classList.remove('hover-second');
		body.classList.remove('body-lock');
	}
})



