<?php

namespace App\Livewire;

use App\Models\UnlimitedManueAndSubs;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class UnlimitedManueAndSub extends Component
{
    use WithPagination;
    public $postId;


    public $isOpen = 0;
    #[Rule('required|min:3')]
    public $title;

    #[Rule('required|min:3')]
    public $description;

    #[Rule('required')]
    public $priority;

    #[Rule('required')]
    public $has_menu;


    #[Rule('required')]
    public $status;
    public $manues;
    public function mount()
    {
        if (!Auth::user()->hasPermissionTo('unlimited_manue_sub.list')) {

            abort(403, 'Unauthorized action.');
        }
        $this->manues = UnlimitedManueAndSubs::all();
    }

    public function create()
    {
        $this->reset('title', 'description', 'priority', 'has_menu', 'status', 'postId');
        $this->openModal();
    }

    public function store()
    {

        $this->validate();

        UnlimitedManueAndSubs::create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'has_menu' => $this->has_menu,
            'status' => $this->status,
        ]);
        session()->flash('success', 'Manue created successfully.');

        $this->reset('title', 'description', 'priority', 'has_menu', 'status');
        $this->closeModal();
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
        if (!Auth::user()->hasPermissionTo('unlimited_manue_sub.list')) {

            abort(403, 'Unauthorized action.');
        }
        return view('livewire.unlimited-manue-and-sub');
    }
}
