$(window).on("load", function(){
    $(".slider").slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 1,
        centerMode: true,
        variableWidth: true
    });
});