<template>
	<div class="radio-input-group">
		<div class="input-group" v-for="option in radioInputOptions" :key="option.id">		
	        <input type="radio" :id="option.id" :value="option.value" v-model="selected" @input="emitSelected(option)">
	        <label :for="option.for">{{ option.label }}</label>
		</div>
    </div>
</template>
<script>
	export default {
		name: 'radio-input-group',
		props: ['radioInputOptions'],
		data: () => ({
			selected: ''
		}),
		mounted () {
			this.selected = this.radioInputOptions[0].value
		},
		methods: {
			emitSelected(option) {
				this.$emit('update:selected', option.value)
			}
		}
	}
</script>
<style lang="scss">
	.radio-input-group {
		.input-group {
			display: inline-block;

			&:not(:last-child) {
				margin-right: 45px;
			}
		}
	}
</style>