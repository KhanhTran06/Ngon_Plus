@extends('layouts.master')
@section('title', 'Địa Chỉ')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4" style="color: #d32f2f; font-weight: bold;">ĐỊA CHỈ CỦA CHÚNG TÔI</h2>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="shadow p-2 bg-white rounded">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7332975515294!2d108.24978007500276!3d15.975298284690664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2sVietnam%20-%20Korea%20University%20of%20Information%20and%20Communication%20Technology.!5e0!3m2!1sen!2s!4v1716782944634!5m2!1sen!2s"
                        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <p class="mt-3 fs-5"><i class="fas fa-map-marker-alt text-danger"></i> Khu Đô thị Đại học Đà Nẵng, Quận Ngũ Hành Sơn, TP. Đà Nẵng</p>
        </div>
    </div>
</div>
@endsection
