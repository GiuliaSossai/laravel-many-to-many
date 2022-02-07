<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id'];
    
    
    public static function createSlug($title){
        //creo lo slug
        $slug = Str::slug($title);
        
        //creo uno slug di base
        $original_slug = $slug;

        //verifico se lo slug c'è nel db con una query: uso first così ottengo un oggetto
        $slug_inDb = Post::where('slug', $slug)->first();

        //se nel db c'è lo slug, gli devo aggiungere un contatore per farlo diventare unico
        //inizializzo il contatore
        $c = 1;

        //faccio ciclo while: finchè lo slug è presente, gli concateno un numero
        while($slug_inDb){
            $slug = $original_slug . '-' . $c;
            $c++;
            //controllo di nuovo la query: c'è anche il nuovo slug? se sì, aumento il contatore e così via finché non trovo uno slug che non c'è e quindi il ciclo finisce
            $slug_inDb = Post::where('slug', $slug)->first();
        }

        return $slug;
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    //metodo per tabella ponte con tabella tags
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
