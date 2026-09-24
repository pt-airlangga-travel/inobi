$u = App\Models\User::first(); $u->password = Hash::make('password123'); $u->save();
