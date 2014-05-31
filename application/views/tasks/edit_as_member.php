<style>
	[class^=slider] { display: inline-block; margin-bottom: 15px; }
	.output { color: #888; font-size: 14px; padding-top: 1px; margin-left: 5px; vertical-align: top;}
  </style>
<script src="<?php echo base_url('js/simple-slider.min.js'); ?>"></script>
<form action="<?php echo current_url(); ?>" method="post" name="form-login">
	<label>progress</label>
	<br/>
		<input type="text" data-slider="true" data-slider-step="1" data-slider-highlight="true" data-slider-range="0,100" name="progress" value="<?php echo $progress; ?>">
		<br/>
	<input type="submit" name="do-create" value="simpan" class="button">
</form>

<script>

//buat progress slider
$("[data-slider]")
.each(function () {
  var input = $(this);
  $("<span>")
	.addClass("output")
	.insertAfter($(this));
})
.bind("slider:ready slider:changed", function (event, data) {
  $(this)
	.nextAll(".output:first")
	  .html(data.value + " %");
});

</script>