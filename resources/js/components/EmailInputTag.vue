<template>
    <div class="email-input-tag">
        <multiselect v-model="recipients" :options="options" :placeholder="placeholder" multiple label="email" track-by="id" class="mb-2" @input="$emit('update:recipients', recipients)" optionsLimit="10" :selectLabel="messages['recipients-select-text']" :deselectLabel="messages['recipients-remove-text']" :selectedLabel="messages['recipients-selected-text']">
            <template slot="singleLabel" slot-scope="props">
                <span class="option__desc">
                    <span class="option__title">{{ props.option.email }}</span>
                </span>
            </template>
            <template slot="option" slot-scope="props">
                <div class="option__desc">
                    <span class="option__title">{{ props.option.name }}</span> (<span class="option__small">{{ props.option.email }}</span>)
                </div>
            </template>
            <span slot="noResult">{{ messages['recipients-no-result'] }}</span>
            <span slot="noOptions">{{ messages['recipients-no-options'] }}</span>
        </multiselect>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'

    export default {
        name: 'email-input-tag',
        props: ['placeholder', 'options', 'messages', 'clearingSelection'],
        components: {
            Multiselect
        },
        data: () => ({
            recipients: []
        }),
        mounted() {
            this.options.reverse();
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
    .email-input-tag {
        &-recipients {
            &-title {
                font-size: 25px;
                font-weight: bold;
                margin-bottom: 20px;
            }

            &-list {
                list-style-type: none;
                padding: 0;

                li {
                    font-size: 15px;

                    &:not(:last-child) {
                        margin-bottom: 10px;
                    }

                    .email-text {
                        color: var(--primary);
                        font-style: italic;
                    }
                }
            }
        }
    }
</style>