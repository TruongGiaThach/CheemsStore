<template>
    <v-dialog :fullscreen="$vuetify.breakpoint.xs" width="500" transition="dialog-bottom-transition" v-model="show">
        <v-card dark>
            <v-container grid-list-xl class="pa-8" >
                <v-row align="center" justify="center">
                    <avatar-uploader v-model="avatar">
                      <div slot="activator">
                        <v-avatar size="150px" v-ripple v-if="!avatar" class="grey lighten-3 mb-3">
                          <span>Click to add avatar</span>
                        </v-avatar>
                        <v-avatar size="150px" v-ripple v-else class="mb-3">
                          <img :src="avatar.imageURL" alt="avatar">
                        </v-avatar>
                      </div>
                    </avatar-uploader>
                </v-row>
                <v-row align="center" justify="center">
                    <v-slide-x-transition>
                      <div v-if="avatar && saved == false">
                        <v-btn class="primary" @click="uploadImage" :loading="saving">Save Avatar</v-btn>
                      </div>
                    </v-slide-x-transition>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
</template>

<script>
import AvatarUploader from './AvatarUploader.vue'
export default {
  data: () => ({
    avatar: null,
    saving: false,
    saved: false
  }),
  props: {
    currentAvatar: {
        type: String,
        required: true
    },
    value: Boolean
  },
  watch: {
    avatar: {
      handler: function() {
        this.saved = false
      },
      deep: true
    }
  },
  computed: {
    show: {
        get () {
            return this.value
        },
        set (value) {
            this.$emit('input', value)
        }
    }
  },
  components: {
      AvatarUploader: AvatarUploader
  },
  methods: {
    uploadImage() {
      this.saving = true
      setTimeout(() => this.savedAvatar(), 1000)
    },
    savedAvatar() {
      this.saving = false
      this.saved = true
    }
  },
};
</script>

<style>
</style>