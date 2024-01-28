<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Brands;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class Brand extends Component
{
    use WithPagination;
    public $postId;

    public $isOpen = 0;
    #[Rule('required|min:3')]
    public $name;

    #[Rule('required|date')]
    public $entry_date;

    public $counter = 0;
    public function create()
    {
        $this->reset('name', 'entry_date', 'postId');
        $this->openModal();
    }
    public function store()
    {
        $this->validate();
        Brands::create([
            'name' => $this->name,
            'entry_date' => $this->entry_date,
        ]);
        session()->flash('success', 'Brand created successfully.');

        $this->reset('name', 'entry_date');
        $this->closeModal();
    }



    public function edit($id)
    {
        $post = Brands::findOrFail($id);
        // dd($post);
        $this->postId = $id;
        $this->name = $post->name;
        $this->entry_date = $post->entry_date;

        $this->openModal();
    }



    public function update()
    {
        if ($this->postId) {
            $post = Brands::findOrFail($this->postId);
            $this->validate();
            $post->update([
                'name' => $this->name,
                'entry_date' => $this->entry_date,
            ]);

            session()->flash('success', 'Brand updated successfully.');
            $this->closeModal();
            $this->reset('name', 'entry_date', 'postId');
        }
    }




    public function delete($id)
    {
        $post = Brands::find($id);
        $post->delete();
        session()->flash('success', 'Brand deleted successfully.');
        $this->reset('name', 'entry_date');

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
        return view('livewire.brand', [
            'posts' => Brands::paginate(5),
        ]);
    }

}
