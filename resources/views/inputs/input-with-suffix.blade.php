<div
    x-data="{ isDirty: {{ !! ($value ?? false) ? 'true' : 'false' }} }"
    {{ $attributes->only('class') }}
>
    <div class="input-group">
        @unless ($hideLabel ?? false)
            @include('ark::inputs.includes.input-label', [
                'name'           => $name,
                'errors'         => $errors,
                'id'             => $id ?? $name,
                'label'          => $label ?? null,
                'tooltip'        => $tooltip ?? null,
                'required'       => $required ?? false,
                'auxiliaryTitle' => $auxiliaryTitle ?? '',
            ])
        @endunless

        <div
            @class([
                'input-wrapper input-wrapper-with-suffix',
                'input-text--error' => $errors->has($name),
            ])
            x-bind:class="{ 'input-wrapper-with-suffix--dirty': !! isDirty }"
        >
            @include('ark::inputs.includes.input-field', [
                'name'           => $name,
                'errors'         => null,
                'id'             => $id ?? $name,
                'inputTypeClass' => 'input-text-with-suffix',
                'inputClass'     => $inputClass ?? '',
                'noModel'        => $noModel ?? false,
                'model'          => $model ?? $name,
                'deferred'       => $deferred ?? false,
                'attributes'     => $attributes->merge(['x-on:change' => 'isDirty = !! $event.target.value']),
            ])

            @if($suffix ?? false)
                <div class="relative input-suffix bg-theme-primary-50 dark:bg-theme-secondary-800">
                    {{ $suffix }}

                    @error($name)
                        @include('ark::inputs.includes.input-error-tooltip', [
                            'error' => $message,
                            'id' => $id ?? $name
                        ])
                    @enderror
                </div>
            @else
                @error($name)
                    @include('ark::inputs.includes.input-error-tooltip', [
                        'error' => $message,
                        'id' => $id ?? $name
                    ])
                @enderror
            @endif
        </div>
    </div>
</div>
