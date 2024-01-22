<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    public function up()
    {

        Schema::table('healthy_details', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('admins')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->foreign('plan_id')->references('id')->on('plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->foreign('coach_Id')->references('id')->on('admins')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->foreign('offer_id')->references('id')->on('offers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('gym_id')->references('id')->on('gym')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->foreign('plan_id')->references('id')->on('plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('subscribe_id')->references('id')->on('subscribe')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->foreign('gym_id')->references('id')->on('gym')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('work', function (Blueprint $table) {
            $table->foreign('gym_id')->references('id')->on('gym')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('chat_id')->references('id')->on('chats')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('nutritional_values', function (Blueprint $table) {
            $table->foreign('food_id')->references('id')->on('nutritional_values')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('player_game', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('players')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('player_game', function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('game')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('levels', function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('game')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('schedules')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('schedule_task', function (Blueprint $table) {
            $table->foreign('schedule_id')->references('id')->on('schedule_task')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('schedule_task', function (Blueprint $table) {
            $table->foreign('task_id')->references('id')->on('task')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('task', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('rates', function (Blueprint $table) {
            $table->foreign('task_id')->references('id')->on('task')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('rates', function (Blueprint $table) {
            $table->foreign('player_id')->references('id')->on('rates')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {

        Schema::table('healthy_details', function (Blueprint $table) {
            $table->dropForeign('healthy_details_player_id_foreign');
        });
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign('chats_palyer_id_foreign');
        });
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign('chats_admin_id_foreign');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->dropForeign('subscribe_player_id_foreign');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->dropForeign('subscribe_plan_id_foreign');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->dropForeign('subscribe_coach_Id_foreign');
        });
        Schema::table('subscribe', function (Blueprint $table) {
            $table->dropForeign('subscribe_offer_id_foreign');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_gym_id_foreign');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('services_plan_id_foreign');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_subscribe_id_foreign');
        });
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->dropForeign('contact_infos_gym_id_foreign');
        });
        Schema::table('work', function (Blueprint $table) {
            $table->dropForeign('work_gym_id_foreign');
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_chat_id_foreign');
        });
        Schema::table('nutritional_values', function (Blueprint $table) {
            $table->dropForeign('nutritional_values_food_id_foreign');
        });
        Schema::table('player_game', function (Blueprint $table) {
            $table->dropForeign('player_game_player_id_foreign');
        });
        Schema::table('levels', function (Blueprint $table) {
            $table->dropForeign('levels_game_id_foreign');
        });
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign('schedules_player_id_foreign');
        });
        Schema::table('schedule_task', function (Blueprint $table) {
            $table->dropForeign('schedule_task_schedule_id_foreign');
        });
        Schema::table('schedule_task', function (Blueprint $table) {
            $table->dropForeign('schedule_task_task_id_foreign');
        });
        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign('task_type_id_foreign');
        });
        Schema::table('rates', function (Blueprint $table) {
            $table->dropForeign('rates_task_id_foreign');
        });
    }
}
