(function($){
  $.fn.imageSelect = function() {
    var $this = $(this);
    var $input = $('#input_'+$this.attr('id'));
    function changeInput(id, $parent, callback) {
      $input.val(id);
      if (callback && typeof(callback) === "function") {
        callback($parent);
      }
    }
    $this.on('click', 'img', function(){
      changeInput($(this).attr('id'), $(this).parent(), function($item){
        $this.find('li').removeClass('active');
        $item.addClass('active');
      });
    });
    return $this;
  };
  $(document).ready(function() {
    $('.image_select').imageSelect();
  });
})(jQuery);