<?php

namespace App\Livewire;

use Livewire\Component;

class FormDemo extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $submitted = false;
    
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function submit()
    {
        $this->validate();
        
        // Simulate processing
        $this->submitted = true;
        
        // Reset form after 3 seconds
        $this->dispatch('form-submitted');
    }
    
    public function resetForm()
    {
        $this->reset(['name', 'email', 'message', 'submitted']);
        $this->resetErrorBag();
    }
    
    public function render()
    {
        return view('livewire.form-demo');
    }
}