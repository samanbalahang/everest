@extends('site.layouts.main')
@section("seo")
<link rel="stylesheet" href="{{asset("assets/css/select2.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/css/sweetalert2.min.css")}}">
<style>
	body {
		direction: rtl !important;
	}

	main header {
		padding: 1rem 0;
	}

	main header ul {
		list-style: none;
		margin : 0;
		padding: 0;
	}

	main header>ul {
		display: flex;
		justify-content: flex-end;
	}

	main nav {
		background-color: #d4e7f5;

	}

	main nav>ul {
		display: flex;
	}

	main header a {
		text-decoration: none;
		color: #626262;
		padding: 1rem;
		display: block;
	}
	#oldsignal div{
		padding: 1rem;
	}
	#oldsignal div:nth-child(odd){
		background-color: #eff0ff;
	}
	#oldsignal div:nth-child(even){
		background-color: #d9fde1;
	}
	.mainMenu,
	.mainHeader {
		display: none;
	}

	:focus {
		outline: 0;
		border-color: #2260ff;
		box-shadow: 0 0 0 4px #b5c9fc;
	}

	.mydict div {
		display: flex;
		flex-wrap: wrap;
		margin-top: 0.5rem;
		justify-content: center;
	}

	.mydict input[type="radio"],
	.mydict input[type="checkbox"] {
		clip: rect(0 0 0 0);
		clip-path: inset(100%);
		height: 1px;
		overflow: hidden;
		position: absolute;
		white-space: nowrap;
		width: 1px;
	}

	.mydict input[type="radio"]:checked+span,
	.mydict input[type="checkbox"]:checked+span {
		box-shadow: 0 0 0 0.0625em #0043ed;
		background-color: #dee7ff;
		z-index: 1;
		color: #0043ed;
	}

	label span {
		display: block;
		cursor: pointer;
		background-color: #fff;
		padding: 0.375em .75em;
		position: relative;
		margin-left: .0625em;
		margin-right: .0625em;
		box-shadow: 0 0 0 0.0625em #b5bfd9;
		letter-spacing: .05em;
		color: #3e4963;
		text-align: center;
		transition: background-color .5s ease;
		border:2px solid black
	}

	label:first-child span {
		border-radius: .375em 0 0 .375em;
	}

	label:last-child span {
		border-radius: 0 .375em .375em 0;
	}

	.rtl {
		direction: rtl !important;
	}
</style>
@endsection
@section('title')
افزودن سیگنال
@endsection
@section('main')
<main>
	@include("site.signal.header")
	<div class="container">

    </div>
</main>
@endsection
@section("scripts")
<script>
    download("test.txt", "{{$textfile}}");
    function download(filename, text) {
        // console.log(text);
        let texts =JSON.parse(text);
        let ex = "";
        texts.forEach(tizer => {
            ex += "0"+tizer +","+ "\n";
        });
        text = ex;
        // console.log(text);
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
        window.location.replace("{{route('site.signal.create')}}");
    }
</script>
@endsection