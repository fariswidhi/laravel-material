<form id="form" action="{{ url('/crud/') }}">
{{csrf_field()}}
{{method_field("POST")}}
<div class="form-group">
	<label>Text</label>
	<input type="text" name="text" class="form-control">
</div>

</form>