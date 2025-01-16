 @foreach($permissions as $permission)
    <div>
        <x-label>
            <input name="permissions[]" type="checkbox"
                   class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   value="{{ $permission->name }}"
                   {{ isset($model) && $model->permissions->contains($permission->id) ? 'checked' : '' }}>
            {{ $permission->display_name ?? $permission->name }} 
       {{--  <small class="text-muted">{{ $permission->model_name }}</small>   --}}
        </x-label>
    </div>
@endforeach  



 {{-- @foreach ($permissions as $id => $name)
    <div class="px-3">
        <x-label>
            <input name="permissions[]" type="checkbox" value="{{ $name }}"
                class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($name) ? 'checked' : '' }}>
            {{ $name }}
        </x-label>
    </div>
@endforeach  --}}