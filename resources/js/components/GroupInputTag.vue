<template>
	<div class="group-input-tag">
		<multiselect v-model="groups" :options="groupOptions" :placeholder="placeholder" multiple label="name" track-by="users" class="mb-2" @input="$emit('update:groupRecipients', recipients)" optionsLimit="10" :selectLabel="messages['recipients-select-text']" :deselectLabel="messages['recipients-remove-text']" :selectedLabel="messages['recipients-selected-text']">
		    <template slot="singleLabel" slot-scope="props">
		    	<span class="option__desc">
		    		<span class="option__title">{{ props.option.name }}</span>
		    	</span>
		    </template>
			<template slot="option" slot-scope="props">
				<div class="option__desc">
					<span class="option__title">{{ props.option.name }}</span> - <span class="option__small">{{ messages['recipients-input-info-total'] + ' ' + props.option.users.length }}</span>
				</div>
			</template>
			<span slot="noResult">{{ messages['recipients-no-result'] }}</span>
			<span slot="noOptions">{{ messages['recipients-no-options'] }}</span>
		</multiselect>
		<input-info v-if="groups && recipients.length > 0" :messages="messages" :recipients="recipients"></input-info>
	</div>
</template>
<script>
	import Multiselect from 'vue-multiselect'
	import InputInfo from './InputInfo'

	export default {
		name: 'group-input-tag',
		props: ['placeholder', 'groupOptions', 'messages'],
		components: {
			Multiselect,
			InputInfo
		},
		data: () => ({
			groups: null
		}),
		mounted() {
			this.groupOptions.reverse();
		},
		computed: {
			recipients() {
				let allUsers = []
				this.groups.forEach((group) => {
					group.users.forEach((user) => {
						if (!allUsers.includes(user)) {
							allUsers.push(user);
						}
					})
				})

				return allUsers
			}
		},
		methods: {
			getOptionName (option) {
				return option.name + ' - ' + this.messages['recipients-group-input-total'] + ' ' + option.users.length
			}
		}
	}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
	
</style>