<template>
    <span>
       <div v-for="(item, index) in items" class="checkbox">
            <label :for="'cb_' + index">
                <input type="checkbox" :name="name + '[]'" :value="item.value" :id="'cb_' + index" :checked="item.checked || false">
                {{item.label}}
            </label>
        </div>
    </span>
</template>

<script>
    export default {
        props: ['items', 'name']
    }
</script>
