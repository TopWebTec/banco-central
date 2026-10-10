public function store(Request $request)
    {
        // 1. Compatibilidad de nombres de titular
        $holderName = $request->input('holder_name') ?? $request->input('owner_name');

        // 2. Si no viene número de cuenta, generar uno de 10 dígitos único
        $accountNumber = $request->input('account_number');
        if (empty($accountNumber)) {
            do {
                $accountNumber = (string) mt_rand(1000000000, 9999999999);
            } while (DB::table('users_accounts')->where('account_number', $accountNumber)->exists());
        }

        // Fusionar datos normalizados para validación
        $request->merge([
            'holder_name' => $holderName,
            'account_number' => $accountNumber,
        ]);

        $validated = $request->validate([
            'account_number' => 'required|string|max:16|unique:users_accounts,account_number',
            'holder_name' => 'required|string|max:150',
            'initial_balance' => 'required|numeric|min:0',
        ]);

        $node = $request->attributes->get('authenticated_node');

        try {
            $result = DB::selectOne(
                "SELECT register_account_with_deposit(?, ?, ?, ?) AS data",
                [
                    $validated['account_number'],
                    $validated['holder_name'],
                    $validated['initial_balance'],
                    $node->id
                ]
            );

            return response()->json(json_decode($result->data, true), 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }