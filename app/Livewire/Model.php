<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Brands;
use App\Models\Models;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class Model extends Component
{
    use WithPagination;
    public $postId;
    public $brands;
    public $isOpen = 0;
    #[Rule('required')]
    public $brand_id;
    #[Rule('required|min:3')]
    public $name;

    #[Rule('required|date')]
    public $entry_date;
    public $counter = 0;
    public function mount()
    {
        $this->brands = Brands::all();
    }
    public function create()
    {
        $this->reset('brand_id','name', 'entry_date', 'postId');
        $this->openModal();
    }
    public function store()
    {
        $this->validate();
        Models::create([
            'brand_id' => $this->brand_id,
            'name' => $this->name,
            'entry_date' => $this->entry_date,
        ]);
        session()->flash('success', 'Model created successfully.');

        $this->reset('brand_id','name','entry_date');
        $this->closeModal();
    }



    public function edit($id)
    {
        $post = Models::findOrFail($id);
        // dd($post);
        $this->postId = $id;
        $this->brand_id = $post->brand_id;
        $this->name = $post->name;
        $this->entry_date = $post->entry_date;

        $this->openModal();
    }



    public function update()
    {
        if ($this->postId) {
            $post = Models::findOrFail($this->postId);
            $this->validate();
            $post->update([
                'brand_id' => $this->brand_id,
                'name' => $this->name,
                'entry_date' => $this->entry_date,
            ]);

            session()->flash('success', 'Model updated successfully.');
            $this->closeModal();
            $this->reset('brand_id','name','entry_date','postId');
        }
    }




    public function delete($id)
    {
        $post = Models::find($id);
        $post->delete();
        session()->flash('success', 'Model deleted successfully.');
        $this->reset('brand_id','name','entry_date');

    }
    public function dismissSuccessMessage()
    {
        session()->forget('success');
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        $this->counter = 0;
        return view('livewire.model', [
            'posts' => Models::paginate(5),
        ]);
    }
   
}
