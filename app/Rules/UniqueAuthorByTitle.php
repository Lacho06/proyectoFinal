<?php

namespace App\Rules;

use App\Models\Author;
use Illuminate\Contracts\Validation\Rule;

class UniqueAuthorByTitle implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    private function getAuthor($id){
        return Author::findOrFail($id);
    }

    private function getCulturalWorksByAuthor($id){
        return $this->getAuthor($id)->culturalWorks;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach($this->getCulturalWorksByAuthor($value) as $culturalWork){
            if($culturalWork->title == $this->title){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute no es un autor válido.';
    }
}
