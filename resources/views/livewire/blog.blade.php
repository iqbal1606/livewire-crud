<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/administrator">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Artikel</li>
        </ol>
    </nav>
    <div class="card">
        @if ($showForm)
        {{-- tambahdata --}}
        <div class="card-header">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Tambah Data</h4>
                <button wire:click="kembali" class="btn btn-warning">
                    <span data-feather="plus"></span> Kembali
                </button>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Masukkan data</h5>
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Judul</label>
                    <input type="text" wire:model="judul" class="form-control">
                    @error('judul') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                    <input type="text" wire:model="deskripsi" class="form-control">
                    @error('deskripsi') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        {{-- end tambah data --}}

        @elseif ($showeditForm)
        {{-- edit data --}}
        <div class="card-header">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Edit</h4>
                <button wire:click="kembali" class="btn btn-warning">
                    <span data-feather="plus"></span> Kembali
                </button>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Masukkan data</h5>
            <form wire:submit.prevent="update">
                <input type="hidden" wire:model="itemid">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Judul</label>
                    <input type="text" wire:model="judul" class="form-control">
                    @error('judul') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                    <input type="text" wire:model="deskripsi" class="form-control">
                    @error('deskripsi') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        {{-- end edit data --}}

        @elseif ($showdetailForm)
        <div class="card-header">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Detail Data</h4>
                <button wire:click="kembali" class="btn btn-warning">
                    <span data-feather="plus"></span> Kembali
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-center">
                <h2 class="card-title mb-0">{{ $data_detail->judul }}</h2>
            </div>
            <hr>
            <h5>Deskripsi :</h5>
          <h1>{{ $data_detail->deskripsi }}</h1>
        </div>
        @else

        {{-- Tabel --}}
        <div class="card-header">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Data Artikel</h4>
                <button wire:click="tambahform" class="btn btn-primary">
                    <span data-feather="plus"></span> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">List Data</h5>
            <p class="m-0">Tampil {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari
                {{ $data->total() }} data</p>
            <div class="d-flex justify-content-between align-content-center mb-2">
                <div class="d-flex">
                    <form>
                        <div class="input-group">
                            <input wire:model="search" type="search" placeholder="Search posts by title...">
                        </div>
                    </form>

                </div>
            </div>
            <table class="table-striped table-bordered table">
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Artikel</th>
                        <th scope="col">deskripsi</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $data->firstItem() + $key }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td class="text-end">
                                <button wire:click='editform({{ $item->id }})'>Edit</button>
                                <button wire:click='hapusform({{ $item->id }})'>Hapus</button>
                                <button wire:click='detailform({{ $item->id }})'>Detail</button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
        @endif

    </div>

</div>
