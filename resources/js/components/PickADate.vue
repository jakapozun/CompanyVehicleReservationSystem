<template>
    <div class="picker">
        <label for="pickup_date">{{ fromText }}:</label>
        <v-date-picker v-model="startDate" is24hr color="green" mode="dateTime" :masks="{inputDateTime24hr: 'YYYY-MM-DD HH:mm'}" :min-date='new Date()' :locale="locale">
            <template v-slot="{ inputValue, inputEvents }">
                <input
                    class="px-1 rounded"
                    :value="inputValue"
                    v-on="inputEvents"
                    name="pickup_date"
                    id="pickup_date"
                />
            </template>
        </v-date-picker>
        <label for="dropoff_date">{{ toText }}:</label>
        <v-date-picker v-model="endDate" is24hr color="green" mode="dateTime"
                       :masks="{inputDateTime24hr: 'YYYY-MM-DD HH:mm'}"
                       :min-date='startDate || new Date()'
                       :locale="locale">
            <template v-slot="{ inputValue, inputEvents }">
                <input
                    class="px-1 rounded"
                    :value="inputValue"
                    v-on="inputEvents"
                    name="dropoff_date"
                    id="dropoff_date"
                />
            </template>
        </v-date-picker>
        <button type="submit" class="btn btn-sm btn-primary" :disabled="checkInputs">{{ searchText}}</button>
        <button class="btn btn-sm btn-outline-danger" @click="resetForm()">{{ resetText }}</button>
    </div>
</template>

<script>
export default {
    name: "PickADate",
    props: {
        initialStartDate: null,
        initialEndDate: null,
        resetText: null,
        fromText: null,
        toText: null,
        searchText: null,
        locale: null
    },
    data() {
        return{
            startDate: null,
            endDate: null,
            isDisabled: true,
        }
    },
    created(){
        if(this.initialStartDate){
            this.startDate = this.initialStartDate;
        }

        if(this.initialEndDate){
            this.endDate = this.initialEndDate;
        }
    },
    methods: {
        resetForm(){
            this.startDate = null;
            this.endDate = null;
        }
    },
    computed: {
        checkInputs(){
            if(this.startDate == null || this.endDate == null){
                return this.isDisabled = true;
            }
            return this.isDisabled = false;
        }
    }
}
</script>

<style scoped>

#pickup_date{
    background: #c5d8dc;
    border: solid 1px black;
    width: 10em;
}

#dropoff_date{
    background: #c5d8dc;
    border: solid 1px black;
    width: 10em;
}

</style>
