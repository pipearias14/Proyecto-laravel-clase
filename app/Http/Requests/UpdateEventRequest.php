<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_name' => ['required', 'max:255', 'unique:events,event_name,' . $this->route('event')->id],
            'event_date' => ['required', 'date'],
            'event_max_capacity' => ['integer', 'min:1'],
            'event_speaker_name' => ['string', 'max:255'],
            'event_location_name' => ['string', 'max:255'],
            'event_meetup_url' => ['url'],
            'event_is_virtual' => ['boolean'],
            'fk_venue_event' => ['exists:venues,id'],
            'event_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
