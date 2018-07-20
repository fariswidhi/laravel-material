<form id="form" action="{{ url('/crud/'.$data->id) }}">
{{csrf_field()}}
{{method_field("PUT")}}
<div class="form-group">
	<label>Text</label>
	<input type="text" name="text" class="form-control" value="{{$data->text}}">
</div>

</form>