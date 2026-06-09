<template>
  <div class="modal fade" ref="editModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="editTaskModalLabel">Edit Progress</h6>
          <button type="button" class="close" aria-label="Close" @click="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="submitForm">
          <div class="modal-body">
            <div class="form-group">
              <label for="editTitle" class="required">Judul</label>
              <input
                type="text"
                class="form-control"
                id="editTitle"
                v-model="form.title"
                required
              />
            </div>
            <div class="form-group">
              <label for="editDescription" class="required">Deskripsi</label>
              <textarea class="form-control" id="editDescription" v-model="form.description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn mb-2 btn-danger" @click="closeModal">Batal</button>
            <button type="submit" class="btn mb-2 btn-primary">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    task: Object
  },
  data() {
    return {
      form: {
        id: null,
        title: '',
        description: ''
      }
    };
  },
  watch: {
    task(newTask) {
      if (!newTask) return;

      this.form = {
        id: newTask.id,
        title: newTask.title,
        description: newTask.description
      };

      this.$nextTick(() => {
        jQuery(this.$refs.editModal).modal('show');
      });
    }
  },
  mounted() {
    if (this.task) {
      this.form.title = this.task.title;
      this.form.description = this.task.description;
    }
  },
  methods: {
    closeModal() {
      jQuery(this.$refs.editModal).modal('hide');
      this.$emit('closed');
    },
    submitForm() {
      const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

      const payload = {
        title: this.form.title,
        description: this.form.description,
        _token: csrfToken
      };

      axios.put(`/tasks/${this.form.id}`, payload)
        .then((response) => {
          // Normalize response safely (never trust backend shape)
          const updatedTask = {
            id: this.form.id,
            title: this.form.title,
            description: this.form.description,
            ...(response?.data || {})
          };

          Swal.fire({
            icon: 'success',
            title: 'Berhasil update data.',
            toast: true,
            position: 'top-end',
            timer: 3000,
            showConfirmButton: false
          });

          // emit FIRST (decoupled from UI side effects)
          this.$emit('task-updated', updatedTask);

          // close modal LAST and safely
          if (this.$refs.editModal) {
            jQuery(this.$refs.editModal).modal('hide');
          }
        })
        .catch((error) => {
          console.log("STATUS:", error?.response?.status);
          console.log("DATA:", error?.response?.data);

          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error?.response?.data?.message || 'Gagal update tugas!'
          });
        });  
    }
  }
};
</script>
