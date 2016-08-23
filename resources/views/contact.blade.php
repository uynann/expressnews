@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="index.html">Home</a></li>
    <li class="active">Contact Us</li>
</ol>

<!--contact-section-starts-->
<div class="contact-section">
    <header>
        <h2 class="heading text-center">Find Us Here</h2>
    </header>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3150859.767904157!2d-96.62081048651531!3d39.536794757966845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1408111832978"> </iframe>
    </div>
    <div class="contact_grid">
        <div class="col-md-8 contact-top">
            <h3>Send us a message</h3>
            <p class="contact_msg">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p>
            <form>
                <div class="to">
                    <input type="text" class="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
                    <input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
                    <input type="text" class="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
                </div>
                <div class="text">
                    <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message:</textarea>
                </div>
                <div class="form-submit1">
                    <input name="submit" type="submit" id="submit" value="Submit Your Message"><br>
                    <p class="m_msg">Make sure you put a valid email</p>
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
        <div class="col-md-4 contact-top_right">
            <h3>contact info</h3>
            <p>diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis.</p>
            <ul class="contact_info">
                <li><span>+1-900-235-2456</span></li>
                <li><span class="msg"><a href="malito:mail@example.com">mail(at)example.com</a></span></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--contact-section-ends-->


@endsection
