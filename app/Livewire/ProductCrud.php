<?php

namespace App\Livewire;
use App\Models\Todo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
class ProductCrud extends Component
{
    use WithPagination;        
     public $postId;
    public $isOpen = 0;
    #[Rule('required|min:3')]
    public $title;
 
    #[Rule('required|min:3')]
    public $description;
    public function create()
    {
        $this->reset('title','description','postId');
        $this->openModal();
    }
    public function store()
    {
       
        $this->validate();
        Todo::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Post created successfully.');
        
        $this->reset('title','description');
        $this->closeModal();
    }
    public function edit($id)
    {
        $post = Todo::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->description = $post->description;
 
        $this->openModal();
    }
    public function update()
    {

        if ($this->postId) {
            $post = Todo::findOrFail($this->postId);
            $this->validate();
            $post->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
            session()->flash('success', 'Post updated successfully.');
            $this->closeModal();
            $this->reset('title', 'description', 'postId');
        }
    }
    public function delete($id)
    {
        Todo::find($id)->delete();
        session()->flash('success', 'Post deleted successfully.');
        $this->reset('title','description');
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
        return view('livewire.product-crud',[
            'posts' => Todo::paginate(5),
        ]);
    }

}
