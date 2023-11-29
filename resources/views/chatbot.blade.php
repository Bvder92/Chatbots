<div>
    <div>
        <!-- Afficher les messages utilisateur -->
    </div>
    <div>
        <!-- Afficher les réponses du chatbot -->
        <p>{{ $botResponse }}</p>
    </div>
    <div>
        <!-- Formulaire pour envoyer des messages au chatbot -->
        <form action="{{ route('chatbot') }}" method="post">
            @csrf
            <input type="text" name="message" placeholder="Envoyer un message">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>
