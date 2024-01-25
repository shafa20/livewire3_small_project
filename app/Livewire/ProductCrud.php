<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; 
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
class ProductCrud extends Component
{
    use WithFileUploads, WithPagination;        
     public $postId;
    public $isOpen = 0;
    #[Rule('required|min:3')]
    public $title;

    #[Rule('required|image|mimes:jpg,JPG,png,PNG|max:1024')]
    public $image;
    #[Rule('required|min:3')]
    public $description;
    public function create()
    {
        $this->reset('title','image','description','postId');
        $this->openModal();
    }
    public function store()
    {
        $this->validate();
        $imagePath = $this->storeImage();

        Todo::create([
            'title' => $this->title,
            'image' => $imagePath,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Post created successfully.');
        
        $this->reset('title','image','description');
        $this->closeModal();
    }

    private function storeImage()
    {
        return $this->image->store('images', 'public');
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
        // $posts =Todo::all();
        // dd($posts);
        return view('livewire.product-crud',[
            'posts' => Todo::paginate(5),
        ]);
    }

}
