@extends('layouts.customer')
@section('title', 'Home')
@section('content')
<!--main area-->
<style type="text/css">
#imgFileUpload{
border-radius: 50%;
height: 12em;
width: 12em;
}
</style>
<main id="main" class="main-site">

<div class="container">

<div class="wrap-breadcrumb">
<ul>
<li class="item-link"><a href="/" class="link">home</a></li>
<li class="item-link"><span>Account Details</span></li>
</ul>
</div>
<div class=" main-content-area">
@if(session('flashuser'))
<p>{{session('flashuser')}}</p>
@endif
<div class="summary summary-checkout">
<div class="wrap-address-billing">
<h3 class="box-title">Profile Details</h3>
<form action="updateaccount" method="post" name="frm-billing" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{$user->id}}"/>
<p class="row-in-form">
<label for="fname">Name<span>*</span></label>
<input id="fname" type="text" name="name" value="{{$user->name}}" placeholder="Your name" required>
</p>
<p class="row-in-form">
<label for="email">Email Addreess:</label>
<input id="email" type="email" name="email" value="{{$user->email}}" placeholder="Type your email" required>
</p>
<p class="row-in-form">
<label for="phone">Phone number<span>*</span></label>
<input id="phone" type="number" name="phone_number" value="{{$user->phone_number}}" placeholder="10 digits format" required maxlength="10">
</p>
<p class="row-in-form">
<label for="phone">Alternate number</label>
<input id="phone" type="number" name="aphone" value="" placeholder="10 digits format" maxlength="10">
</p>

<p class="row-in-form">
<label for="phone">Select Profile Photo</label>
<img id="imgFileUpload" alt="Select File" width="100px" height="100px" title="Select File" src="/storage/files/{{$user->profile_pic}}" style="cursor: pointer" />
<br />
<span id="spnFilePath"></span>
<input type="file" id="FileUpload1" name="profile_pic" onchange="loadFile(event)" style="display: none"/>
</p>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
var fileupload = $("#FileUpload1");
var filePath = $("#spnFilePath");
var image = $("#imgFileUpload");
image.click(function () {
fileupload.click();
});
fileupload.change(function () {
var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
filePath.html("<b>Selected File: </b>" + fileName);
});
});
var loadFile = function (event) {
var image = document.getElementById("imgFileUpload");
image.src = URL.createObjectURL(event.target.files[0]);
};

</script>


</div>
</div>				
<div class="summary summary-checkout">
<div class="wrap-address-billing">
<h3 class="box-title">BILLING ADDRESS</h3>
<p class="row-in-form">
<label for="add">Address 1:<span>*</span></label>
<input id="add" type="text" name="address_1" value="{{$user->address_1}}" placeholder="Street at apartment number" required>
</p>
<p class="row-in-form">
<label for="add">Address 2:</label>
<input id="add" type="text" name="address_2" value="{{$user->address_2}}" placeholder="Address Line 2">
</p>
<p class="row-in-form">
<label for="country">Country<span>*</span></label>
<input id="country" type="text" name="country_id" value="{{$user->country_id}}" placeholder="India">
</p>
<p class="row-in-form">
<label for="country">State<span>*</span></label>
<input id="country" type="text" name="state_id" value="{{$user->state_id}}" placeholder="West Bengal">
</p>
<p class="row-in-form">
<label for="city">Town / City<span>*</span></label>
<input id="city" type="text" name="city_id" value="{{$user->city_id}}" placeholder="Kolkata">
</p>
<p class="row-in-form">
<label for="zip-code">Postcode / ZIP:<span>*</span></label>
<input id="zip-code" type="number" name="zip_code" value="{{$user->zip_code}}" placeholder="Your postal code">
</p>
<button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
</form>
</div>
</div>


</div><!--end main content area-->
</div><!--end container-->

</main>
<!--main area-->
@endsection