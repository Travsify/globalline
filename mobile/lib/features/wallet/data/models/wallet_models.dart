// Models for GlobalLine Wallet

class Wallet {
  final double balance;
  final String currency;
  final List<WalletTransaction> transactions;

  Wallet({
    required this.balance,
    required this.currency,
    required this.transactions,
  });

  factory Wallet.fromJson(Map<String, dynamic> json) {
    return Wallet(
      balance: (json['balance'] as num?)?.toDouble() ?? 0.0,
      currency: json['currency']?.toString() ?? 'USD',
      transactions: (json['transactions'] as List?)
          ?.map((e) => WalletTransaction.fromJson(e as Map<String, dynamic>))
          .toList() ?? [],
    );
  }

  Map<String, dynamic> toJson() => {
    'balance': balance,
    'currency': currency,
    'transactions': transactions.map((e) => e.toJson()).toList(),
  };
}

class WalletTransaction {
  final String id;
  final String type;
  final double amount;
  final String description;
  final DateTime date;
  final String status;
  final String? currency;
  final Map<String, dynamic>? metadata;

  WalletTransaction({
    required this.id,
    required this.type,
    required this.amount,
    required this.description,
    required this.date,
    required this.status,
    this.currency,
    this.metadata,
  });

  factory WalletTransaction.fromJson(Map<String, dynamic> json) {
    return WalletTransaction(
      id: json['id']?.toString() ?? '',
      type: json['type']?.toString() ?? json['entry_type']?.toString() ?? 'credit',
      amount: (json['amount'] as num?)?.toDouble() ?? 0.0,
      description: json['description']?.toString() ?? '',
      date: DateTime.tryParse(json['date']?.toString() ?? json['created_at']?.toString() ?? '') ?? DateTime.now(),
      status: json['status']?.toString() ?? 'completed',
      currency: json['currency']?.toString(),
      metadata: json['metadata'] is Map<String, dynamic> ? json['metadata'] as Map<String, dynamic> : null,
    );
  }

  Map<String, dynamic> toJson() => {
    'id': id,
    'type': type,
    'amount': amount,
    'description': description,
    'date': date.toIso8601String(),
    'status': status,
    'currency': currency,
    'metadata': metadata,
  };
}

/// Fee breakdown returned by /wallet/preview-transfer.
class TransferPreview {
  final double sendAmount;
  final double transferFee;
  final double fxMarkupAmount;
  final double totalFees;
  final double amountAfterFees;
  final double exchangeRate;
  final String exchangeRateDisplay;
  final double receiveAmount;
  final String sendCurrency;
  final String receiveCurrency;
  final bool isCrossCurrency;
  final String corridor;

  TransferPreview({
    required this.sendAmount,
    required this.transferFee,
    required this.fxMarkupAmount,
    required this.totalFees,
    required this.amountAfterFees,
    required this.exchangeRate,
    required this.exchangeRateDisplay,
    required this.receiveAmount,
    required this.sendCurrency,
    required this.receiveCurrency,
    required this.isCrossCurrency,
    required this.corridor,
  });

  factory TransferPreview.fromJson(Map<String, dynamic> json) {
    return TransferPreview(
      sendAmount: (json['send_amount'] as num?)?.toDouble() ?? 0.0,
      transferFee: (json['transfer_fee'] as num?)?.toDouble() ?? 0.0,
      fxMarkupAmount: (json['fx_markup_amount'] as num?)?.toDouble() ?? 0.0,
      totalFees: (json['total_fees'] as num?)?.toDouble() ?? 0.0,
      amountAfterFees: (json['amount_after_fees'] as num?)?.toDouble() ?? 0.0,
      exchangeRate: (json['exchange_rate'] as num?)?.toDouble() ?? 0.0,
      exchangeRateDisplay: json['exchange_rate_display']?.toString() ?? '',
      receiveAmount: (json['receive_amount'] as num?)?.toDouble() ?? 0.0,
      sendCurrency: json['send_currency']?.toString() ?? 'USD',
      receiveCurrency: json['receive_currency']?.toString() ?? 'USD',
      isCrossCurrency: json['is_cross_currency'] == true,
      corridor: json['corridor']?.toString() ?? '',
    );
  }
}

/// Rate lock returned by /wallet/lock-rate.
class RateLock {
  final String lockId;
  final String fromCurrency;
  final String toCurrency;
  final double rate;
  final double markupPct;
  final DateTime expiresAt;

  RateLock({
    required this.lockId,
    required this.fromCurrency,
    required this.toCurrency,
    required this.rate,
    required this.markupPct,
    required this.expiresAt,
  });

  factory RateLock.fromJson(Map<String, dynamic> json) {
    return RateLock(
      lockId: json['lock_id']?.toString() ?? '',
      fromCurrency: json['from_currency']?.toString() ?? 'USD',
      toCurrency: json['to_currency']?.toString() ?? 'USD',
      rate: (json['rate'] as num?)?.toDouble() ?? 0.0,
      markupPct: (json['markup_pct'] as num?)?.toDouble() ?? 0.0,
      expiresAt: DateTime.tryParse(json['expires_at']?.toString() ?? '') ?? DateTime.now(),
    );
  }

  bool get isExpired => DateTime.now().isAfter(expiresAt);
}

/// Typed currency balance.
class CurrencyBalance {
  final String currency;
  final double amount;

  CurrencyBalance({required this.currency, required this.amount});

  factory CurrencyBalance.fromJson(Map<String, dynamic> json) {
    return CurrencyBalance(
      currency: json['currency']?.toString() ?? 'USD',
      amount: (json['amount'] as num?)?.toDouble() ?? 0.0,
    );
  }

  String get symbol {
    switch (currency) {
      case 'NGN': return '₦';
      case 'CNY': return '¥';
      case 'GBP': return '£';
      case 'EUR': return '€';
      default: return '\$';
    }
  }
}
