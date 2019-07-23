@extends('admin.master')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">ویرایش لغت </h1>
        </div>

        <form action="{{ route('word.update' , ['id' => $word->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            @include('Admin.section.errors')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="words">لغت انگلیسی</label>
                    <textarea class="form-control" id="words" name="words" placeholder="لغت انگلیسی">{{ $word->words }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="meaning">معنای فارسی</label>
                    <textarea class="form-control" id="meaning" name="meaning" placeholder="معنای فارسی">{{ $word->meaning }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </form>

    </main>

@endsection