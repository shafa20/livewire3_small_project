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
     public $imagePreview;
    public $isOpen = 0;
    #[Rule('required|min:3')]
    public $title;

    #[Rule('required|image|mimes:jpg,JPG,png,PNG|max:1024')]
    public $image;
    #[Rule('required|min:3')]
    public $description;
    public $counter = 0;
    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:jpg,png|max:1024',
        ]);

        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function create()
    {
        $this->reset('title','image','description','postId','imagePreview');
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
        
        $this->reset('title','image','description', 'imagePreview');
        $this->closeModal();
    }
  
    private function storeImage()
    {
        return $this->image->store('images', 'public');
    }

   

    public function edit($id)
    {
        $post = Todo::findOrFail($id);
       // dd($post);
        $this->postId = $id;
        $this->title = $post->title;
        $this->image = $post->image;
        $this->description = $post->description;
 
        $this->openModal();
    }
  

   
    public function update()
{
    if ($this->postId) {
        $post = Todo::findOrFail($this->postId);

        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:3',
        ]);

        if ($this->image && is_object($this->image)) {
            // Delete the old image if a new image is uploaded
            Storage::disk('public')->delete($post->image);

            // Update the image field with the new image path
            $post->update([
                'image' => $this->image->store('images', 'public'),
            ]);
        }

        // Update title and description
        $post->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Post updated successfully.');
        $this->closeModal();
        $this->reset('title', 'image', 'description', 'postId');
    }
}

    
    
    
    public function delete($id)
    {
        $post = Todo::find($id);

        if ($post) {
            Storage::disk('public')->delete($post->image); // Delete the associated image
            $post->delete();
            session()->flash('success', 'Post deleted successfully.');
            $this->reset('title', 'description');
        }
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
    {   $this->counter = 0;
        return view('livewire.product-crud',[
            'posts' => Todo::paginate(5),
        ]);
    }

}
