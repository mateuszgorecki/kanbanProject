$(document).on("click", "div.collumn", function (){
  $(this).css('background-color', '#fff')
  $(this).css('transform', 'scale(1.1)')
  $(this).siblings().css('background', 'linear-gradient(135deg, rgba(245, 179, 30,.7) 0%, rgba(128, 79, 7,.7) 100%)')
  $(this).siblings().css('transform', 'scale(1)')
})