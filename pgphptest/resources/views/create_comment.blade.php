<div id="comment-section" class="d-none">
<div class="col-md-12">
<form action="/" method="POST">
	@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Comment</label>
    <input type="hidden" name="id" value="{{ $user->id }}">
    <input type="text" class="form-control" name="comment" placeholder="Enter comment">
  </div>
  
  <button type="submit" class="btn btn-primary text-white mt-2">Submit</button>
</form>

</div>
