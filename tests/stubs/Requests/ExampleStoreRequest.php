<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Support\Facades\DB;

class ExampleStoreRequest extends Request
{
    protected $validator;

    public function __construct(ValidatorFactory $validatorFactory)
    {
        parent::__construct();

        $this->validator = $validatorFactory;

        // Manually set the presence verifier with the connection resolver
        $this->validator->setPresenceVerifier(new DatabasePresenceVerifier(app('db')));
    }

    public function validated()
    {
        $validator = $this->validator->make(
            $this->json()->all(),
            $this->rules(),
            $this->messages()
        );

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    public function rules()
    {
        return [
  'name' => 'required|string',
];
    }

    public function messages()
    {
        return [];
    }
}