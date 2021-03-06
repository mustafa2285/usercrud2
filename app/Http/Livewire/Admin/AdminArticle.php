<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Article;

class AdminArticle extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title_search;

    public $name;
    public $article_id;
    public $title;
    public $article;
    public $image;

    public $rules = [
        'name' => 'required',
        'title' => 'required|min:1',
        'article' => 'required|min:200',
        'image' => 'image|nullable|mimes:jpg,jpeg,png',
        ];

    


    public function render()
    {
        $users = User::all();
        $articles = Article::when($this->title_search, function($query, $search){
            return $query->where('title', 'LIKE',"%$search%");
        })->paginate(5);
        return view('livewire.admin.admin-article', compact('articles','users'));
    }

    public function cancel()
    {
        $this->title = '';
        $this->article = '';
    }

    public function newArticle(){
         $this->validate();

        $new = new Article();
        $new->user_id = User::find($this->name)->id;
        $new->title = $this->title;
        $new->article = $this->article;

        if (!empty($this->image)){
            $name = $this->image->store('img', 'public');
            $new->image = $name;
        }
        

        $new->save();
        $this->reset();

        $this->emit('add-user');

        session()->flash('message', 'Makale Başarıyla Eklendi');
    }

    public function getArticle(Article $articles){
        $this->title = $articles->title;
        $this->article = $articles->article;
        $this->article_id = $articles->id;
    }

    public function updateArticle(){
        $this->validate();

        $articles = Article::where('id',$this->article_id)->first();
        $articles->user_id = User::find($this->name)->id;
        $articles->title = $this->title;
        $articles->article = $this->article;
        if (!empty($this->image)){
            $name = $this->image->store('img', 'public');
            $articles->image = $name;
        }
        $articles->save();
        $this->reset();
        $this->emit('update-user');

        session()->flash('message', 'Makale Başarıyla Güncellendi');
    }

    public function getArticle2(Article $articles){
        $this->title = $articles->title;
        $this->article_id = $articles->id;
    }

    public function destroy(){
        
        $articles = Article::where('id',$this->article_id)->first();
        $articles->delete();
        $this->emit('delete-user');

        session()->flash('message', 'Makale Silindi');
        
    }


}
