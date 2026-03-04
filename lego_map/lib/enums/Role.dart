enum Role {
  admin('admin'),
  user('user');

  final String value;

  const Role(this.value);

  static Role fromString(String? role) {
    return Role.values.firstWhere(
          (e) => e.value == role?.toLowerCase(),
      orElse: () => Role.user,
    );
  }
}