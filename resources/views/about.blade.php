@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="index.html">Home</a></li>
    <li class="active">About</li>
</ol>

<div class="about">
    <h2 class="head">About Us</h2>
    <h5>LITTLE BIT ABOUT US</h5>
    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here.</p>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
    <div class="more-address">
        <address>
            <strong>Express News</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            <abbr title="Phone">P :</abbr> (123) 456-7890
        </address>
        <address>
            <strong>Email</strong><br>
            <a href="mailto:info@example.com">mail@example.com</a>
        </address>
    </div>

</div>


@endsection
