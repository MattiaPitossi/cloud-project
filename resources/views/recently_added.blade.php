@extends('layouts.master')
@section('content')



    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">File Name</th>
                <th scope="col" class="text-center">Added</th>
                <th scope="col" class="text-center">Size</th>
                <th scope="col" class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @if ($file_uploaded->count())
                @foreach ($file_uploaded as $file)
                    <tr>
                        <td class="align-middle text-center">{{ $file->name }}</td>
                        <td class="align-middle text-center">{{ $file->created_at }}</td>
                        <td class="align-middle text-center">{{ $file->size }}</td>
                        <td class="align-middle text-center">
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col col-lg-2">
                                        <a href="{{ route('downloadfile', $file->name) }}" style="font-size:25px">
                                            <i class="bi bi-download" style="font-size: 1.3rem"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @include('edit_modal')
                        </td>
                    </tr>
                @endforeach
            @else

                <tr>
                    <td colspan="2">No rows to show</td>
                </tr>

            @endif
        </tbody>
    </table>


@endsection('content')
