<?php

namespace App\Http\Livewire;

use App\Models\Blog as ModelsBlog;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $showForm = false;

    // edit
    public $showeditForm = false;
    public $itemid;
    public $editedItem;


    //  add data
    public $judul;
    public $deskripsi;

    public $showdetailForm;
    public $data_detail;



    // tampil data index
    public function render()
    {
        $data = ModelsBlog::where('judul', 'like', '%' . $this->search . '%')
                ->orderByDesc('created_at')
                ->paginate(10);
                return view('livewire.blog', [
                    'data' => $data,
                ])->extends('layouts.master')->section('content');
    }

    // ganti tampilan tambah
    public function tambahform()
    {
        $this->showForm = true;
    }

    protected $rules = [
        'judul' => 'required|min:6',
        'deskripsi' => 'required',
    ];

    protected $messages = [
        'judul.required' => 'Judul Tidak Boleh Kosong',
        'judul.min' => 'Penulisan Minimal 6 Karakter',
        'deskripsi.required' => 'deskripsi tidak boleh kosong',
    ];

    public function updated($propertyName)
    {
        // dd($propertyName);
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();
        ModelsBlog::create($validatedData);
        //redirect
        return redirect()->to('/');
    }


    // edit data
    public function editform($id)
    {
        $this->showeditForm = true;
        $this->itemid = $id;
        $this->editedItem = ModelsBlog::find($id);

        if ($this->editedItem) {
            $this->judul = $this->editedItem->judul;
            $this->deskripsi = $this->editedItem->deskripsi;
        }
    }
    public function update()
    {
        $validatedData = $this->validate();
        ModelsBlog::find($this->itemid)->update($validatedData);
        //redirect
        return redirect()->to('/');
    }
    // hapus form
    public function hapusform($id)
    {
        $this->itemid = $id;
        $hapus_form = ModelsBlog::find($this->itemid);
        if($hapus_form) {
            $hapus_form->delete();
         }
           //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        // redirect
        return redirect()->to('/');
    }

    public function detailform($id)
    {
        $this->showdetailForm = true;
        $this->itemid = $id;
        if($this->itemid) {
            $this->data_detail = ModelsBlog::find($this->itemid);
        }
    }

    public function kembali()
    {
        $this->showForm = false;
        $this->showeditForm = false;
        $this->showdetailForm = false;
    }
}
