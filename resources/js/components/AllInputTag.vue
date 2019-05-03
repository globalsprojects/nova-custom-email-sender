<template>
	<div class="all-input-tag">
		<toggle-button class="mb-3" :width="60" :height="26" color="var(--primary)" v-model="sendToAll" @change="$emit('toggle:sentToAll', sendToAll)"/>
		<input-info v-if="sendToAll" :messages="messages" :recipients="recipients"></input-info>
	</div>
</template>
<script>
    import { ToggleButton } from 'vue-js-toggle-button'
    import InputInfo from './InputInfo'

	export default {
		name: 'all-input-tag',
		components: {
			ToggleButton,
			InputInfo
		},
		props: [ 'messages', 'recipients' ],
		data: () => ({
			sendToAll: false
		})
	}
</script>
<style lang="scss">
	
</style>