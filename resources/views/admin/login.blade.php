@extends('admin.layouts.admin')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{!! route('admin_login') !!}">
    @csrf
    
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
  </form>
  {{-- <div id="content">

  </div> --}}
{{-- <script type="text/javascript">
    const userAction = async () => {
        const response = await fetch('/admin/users');
        const myJson = await response.json(); //extract JSON from the http response
        var html = "";
        myJson.forEach(function(item) {
            html += "<p>" + item.name +","+ item.age + "</p>";
        })
        document.getElementById('content').innerHTML = html;
        console.log(myJson);
        // do something with myJson
    }
userAction();

    // userAction;


</script> --}}
  
@stop