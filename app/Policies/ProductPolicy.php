<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Voir la liste de tous les produits : autorisé pour tout utilisateur connecté.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Voir la fiche d'un produit : autorisé si l'utilisateur en est le propriétaire
     * ou si le produit est public.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->id === $product->user_id || $product->is_public;
    }

    /**
     * Créer un produit : autorisé pour tout utilisateur connecté.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Modifier un produit : autorisé uniquement pour le propriétaire.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }

    /**
     * Supprimer un produit : autorisé uniquement pour le propriétaire.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }
}
