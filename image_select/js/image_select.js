(function($){
  $.fn.imageSelect = function() {
    var $this = $(this);
    var $list = $this.find('li');
    var $input = $('#input_'+$this.attr('id'));
    console.log($input);
    function changeInput(id, $parent, callback) {
      $input.val(id);
      if (callback && typeof(callback) === "function") {
        callback($parent);
      }
    }
    $this.on('click', 'img', function(){
      changeInput($(this).attr('id'), $(this).parent(), function($item){
        $list.removeClass('active');
        $item.addClass('active');
      });
    });
    $this.on('click', '.active', function() {
      $(this).removeClass('active');
      $input.val('');
    });
    return $this;
  };
  $(document).ready(function() {
    $('.image_select').each(function() {
      $(this).imageSelect();
    });
  });
})(jQuery);