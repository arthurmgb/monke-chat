<div>
    <div wire:key="inputchat" wire:ignore class="chat-input d-flex flex-row align-items-center">

        <textarea id="t-area" wire:key="txtarea" wire:ignore class="input-msg mx-2" rows="1" autocomplete="off" placeholder="Mensagem" wire:model.defer="mensagem" wire:click.prevent="scrollDown"></textarea>

        <button class="btn btn-lg me-2 btn-send" wire:click.prevent="sendMessage()" wire:loading.attr="disabled">
            <i class="fas fa-paper-plane"></i>
        </button>

    </div>

    <script>
        var t = document.getElementById("t-area");
        t.addEventListener("blur", (e)=>{
            t.focus()
        })
    </script>

</div>
