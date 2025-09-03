<!-- Find a car form -->
<section class="find-a-car">
    <div class="container">
        <form
            action="{{ route('car.search') }}"
            method="GET"
            class="find-a-car-form card flex p-medium"
        >
            <div class="find-a-car-inputs">
                <div>
                    <x-select-maker :value="request('maker_id')"/>
                </div>
                <div>
                   <x-select-model :value="request('model_id')"/>
                </div>
                <div>
                    <x-select-state :value="request('state_id')"/>
                </div>
                <div>
                   <x-select-city :value="request('city_id')"/>
                </div>
                <div>
                   <x-select-car-type :value="request('car_type_id')"/>
                </div>
                <div>
                    <input type="number" placeholder="Year From" name="year_from"/>
                </div>
                <div>
                    <input 
                    type="number" 
                    placeholder="Year To" 
                    name="year_to"
                    value="{{ request('year_to')}}"
                    />
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Price From"
                        name="price_from"
                        value="{{ request('price_from')}}"
                    />
                </div>
                <div>
                    <input 
                    type="number" 
                    placeholder="Price To" 
                    name="price_to"
                    value=" {{ request('price_to')}} "
                    />
                </div>
                <div>
                    <x-select-fuel-type :value="request('fuel_type_id')/>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                </button>
                <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>
<!--/ Find a car form -->
