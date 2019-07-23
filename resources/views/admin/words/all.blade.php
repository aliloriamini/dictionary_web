@extends('admin.master')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">مدیریت لغات انگلیسی</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ route('word.create') }}"><button class="btn btn-sm btn-success">افزودن لغت</button></a>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <form action="{{ url('word/search') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group form-inline">
                                <label for="search">جستجو :</label>
                                <input type="text" class="form-control" id="search" name="search" style="margin-right: 5px;
                                border-top-left-radius:0px ;border-bottom-left-radius: 0px;" placeholder="جستجو..."/>
                                <button type="submit" class="btn btn-primary fa fa-search" style="padding: 11px;
                                border-top-right-radius:0px ;border-bottom-right-radius: 0px;"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm table-bordered text-center">
                <thead>
                <tr>
                    <th class="text-center">معنای انگلیسی</th>
                    <th class="text-center">معنای فارسی</th>
                    <th class="text-center">تغیرات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($words as $word)
                <tr>
                    <td><a href="{{ route('word.show' , ['id' => $word->id]) }}" style="color: black;">{{$word->words }}</a></td>
                    <td>{{$word->meaning}}</td>
                    <td>
                        <form action="{{ route('word.destroy'  , ['id' => $word->id]) }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="btn-group btn-group-xs">
                                <a href="{{ route('word.edit' , ['id' => $word->id]) }}"  class="btn btn-sm btn-primary">ویرایش</a>
                                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection