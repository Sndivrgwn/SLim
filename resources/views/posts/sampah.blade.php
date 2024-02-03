@extends('layouts.header')
@section('content')
 <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex pe-3">
                <h6 class="text-white text-capitalize ps-3">posts</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Isi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tanggal dibuat</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tanggal dihapus</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kembalikan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">hapus permanen</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($post as $pos)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="badge badge-sm bg-gradient-info">{{ $pos->judul }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        {{ Str::limit($pos->content, 30, '...') }}
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">
                        <img src="{{ Storage::url('public/posts/').$pos->image }}" class="rounded object-fit-cover" style="width: 150px">
                        </span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ "$pos->created_at" }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ "$pos->deleted_at" }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <a href="{{ url('post/restore/' . $pos->id) }}" class="text-light font-weight-bold text-xs badge bg-warning" data-toggle="tooltip" data-original-title="restore">
                          <i class="material-icons opacity-10"></i>
                        </a>
                      </td>
                      <td class="align-middle text-center">
                        <a href="{{ url('post/forcedelete/' . $pos->id) }}" class="text-light font-weight-bold text-xs badge bg-warning" data-toggle="tooltip" data-original-title="force delete post">
                          <i class="material-icons opacity-10"></i>
                        </a>
                      </td>
                      
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection