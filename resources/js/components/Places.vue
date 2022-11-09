<template>
    <div>
        <input type="text" name="destination" class="form-control" id="autocomplete" required>
    </div>
</template>
<script>
export default {

    mounted() {
        new google.maps.places.Autocomplete(
            document.getElementById('autocomplete')
        )
    }
}
</script>
