@extends('layouts.admin')
@section('header_title', 'Tạo Chương Trình Khuyến Mãi')

@section('content')
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('admin.promotions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Mã Code (Ví dụ: SALE50)</label>
                    <input type="text" name="code" class="form-control text-uppercase" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giảm theo tiền (VNĐ)</label>
                        <input type="number" name="discount_amount" class="form-control" placeholder="Nhập số tiền">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hoặc Giảm theo %</label>
                        <input type="number" name="discount_percent" class="form-control" placeholder="Nhập % (0-100)">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ngày bắt đầu</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ngày hết hạn</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">KÍCH HOẠT MÃ</button>
            </form>
        </div>
    </div>
@endsection
